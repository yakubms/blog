window.$ = window.jQuery = require('jquery');
require('popper.js');
require('bootstrap');

import 'highlight.js/styles/tomorrow-night-eighties.css';
import hljs from 'highlight.js/lib/highlight';
import javascript from 'highlight.js/lib/languages/javascript';
import apache from 'highlight.js/lib/languages/apache';
import bash from 'highlight.js/lib/languages/bash';
import css from 'highlight.js/lib/languages/css';
import dockerfile from 'highlight.js/lib/languages/dockerfile';
import htmlbars from 'highlight.js/lib/languages/htmlbars';
import json from 'highlight.js/lib/languages/json';
import less from 'highlight.js/lib/languages/less';
import nginx from 'highlight.js/lib/languages/nginx';
import powershell from 'highlight.js/lib/languages/powershell';
import php from 'highlight.js/lib/languages/php';
import scss from 'highlight.js/lib/languages/scss';
import sql from 'highlight.js/lib/languages/sql';
import twig from 'highlight.js/lib/languages/twig';

hljs.registerLanguage('apache', apache);
hljs.registerLanguage('bash', bash);
hljs.registerLanguage('css', css);
hljs.registerLanguage('dockerfile', dockerfile);
hljs.registerLanguage('htmlbars', htmlbars);
hljs.registerLanguage('json', json);
hljs.registerLanguage('less', less);
hljs.registerLanguage('nginx', nginx);
hljs.registerLanguage('powershell', powershell);
hljs.registerLanguage('php', php);
hljs.registerLanguage('scss', scss);
hljs.registerLanguage('sql', sql);
hljs.registerLanguage('twig', twig);
hljs.registerLanguage('javascript', javascript);

hljs.initHighlightingOnLoad();

$(function() { // Shorthand for $( document ).ready()
    "use strict";
    // Your js script is below this line
    // --------------------------------------------------------------------- //
});
