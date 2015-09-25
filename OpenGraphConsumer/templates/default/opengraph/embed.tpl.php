<?php
$embedded = '';
$body = Idno\Core\site()->triggerEvent('url/expandintext', ['object' => $vars['object']], $vars['object']->body); 

if (preg_match_all('/\s+(https?:\/\/[^\s]+)/i', $body, $matches)) {
    foreach ($matches[1] as $m) {
        // Parse with opengraph
        $graph = OpenGraph::fetch($m);
        $embedded .= "<div class=\"OpenGraphContainer\">";
        $embedded .= "<a href=\"{$m}\" target=\"_blank\"><div>";
        if($graph->image) {
            $embedded .= "<div class=\"OpenGraphImage\">" .
                            "<img width=\"100px\"src=\"{$graph->image}\"/></div>";
        }
        else {
            $linkimg = Idno\Core\site()->config()->getDisplayURL() . 
                            "IdnoPlugins/OpenGraphConsumer/images/hyperlink.png";
            $embedded .= "<div class=\"OpenGraphImage\">" .
                            "<img width=\"100px\" src=\"{$linkimg}\"/></div>";
        }
        $embedded .= "<div class=\"OpenGraphContentOuter\">";
        $embedded .= "<div class=\"OpenGraphContent\">";
        if($graph->title) {
            $embedded .= "<strong>{$graph->title}</strong>";
        }
        if($graph->description) {
            // Trim it down
            if(strlen($graph->description) > 300)
                $desc = substr($graph->description, 0, 300) . "...";
            else
                $desc = $graph->description;
            $embedded .= "<p style=\"font-size:0.7em;\">{$desc}</p>";
        }
        $embedded .= "</div>";
        $embedded .= "</div>";
        $embedded .= "</a>";
        $embedded .= "</div>";
    }
}

echo $embedded;
?>
