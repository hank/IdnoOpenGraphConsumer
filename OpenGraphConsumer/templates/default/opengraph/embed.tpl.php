<?php
$embedded = '';
$body = Idno\Core\site()->triggerEvent('url/expandintext', ['object' => $vars['object']], $vars['object']->body); 

if (preg_match_all('/\s+(https?:\/\/[^\s]+)/i', $body, $matches)) {
    foreach ($matches[1] as $m) {
        // Parse with opengraph
        $graph = OpenGraph::fetch($m);
        $embedded .= "<a href=\"{$m}\" target=\"_blank\"><div>";
        if($graph->image) {
            $embedded .= "<span class=\"OpenGraphImage\"style=\"float:left\">" .
                            "<img width=\"100px\"src=\"{$graph->image}\"/></span>";
        }
        else {
            $linkimg = Idno\Core\site()->config()->getDisplayURL() . 
                            "IdnoPlugins/OpenGraphConsumer/images/hyperlink.png";
            $embedded .= "<span class=\"OpenGraphImage\"style=\"float:left\">" .
                            "<img width=\"100px\"src=\"{$linkimg}\"/></span>";
        }
        $embedded .= "<span class=\"OpenGraphContent\" style=\"float:left\">";
        if($graph->title) {
            $embedded .= "<strong>{$graph->title}</strong>";
        }
        if($graph->description) {
            $embedded .= "<p style=\"font-size:0.7em;\">{$graph->description}</p>";
        }
        $embedded .= "</span>";
        $embedded .= "</div></a>";
    }
}

echo $embedded;
?>
