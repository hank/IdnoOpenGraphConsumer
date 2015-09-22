<?php
    namespace IdnoPlugins\OpenGraphConsumer {
        class Main extends \Idno\Common\Plugin {
            function registerPages() {                
                \Idno\Core\site()->template()->extendTemplate('entity/content/embed','opengraph/embed');
                # Register stylesheet
                \Idno\Core\site()->template()->extendTemplate('shell/head', 'styles/shell/head');
            }
        }
        require 'OpenGraph.php';
    }
