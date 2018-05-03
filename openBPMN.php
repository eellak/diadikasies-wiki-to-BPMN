<html>
<head>
  <title>bpmn-js url viewer demo</title>

  <style>
    body {
      font-family: 'Arial', sans-serif;
    }
    .header input[type=text] {
      width: 300px;
      max-width: 100%;
    }
    .console textarea {
      width: 100%;
      min-height: 80px;
      border: none;
      padding: 0;
    }
    .canvas {
      border: solid 1px black;
    }
  </style>
</head>
<body>

  <div class="header">
    <h3>Open BPMN 2.0 diagram from URL</h3>
    <p>
      <input type="text" id="js-url" placeholder="path to BPMN here..." value="
<?php
echo urldecode($_GET["bpmnUrl"]);
?>
" /><button id="js-open">Open</button>
    </p>
    <p>
      <small>Hint: try <code>http://.../diagrams/xxx.bpmn</code></small>
    </p>
  </div>

  <div class="canvas">
    <div id="js-canvas"></div>
  </div>

  <div class="console">
    <h3>Console</h3>
    <textarea id="js-console"></textarea>
  </div>

  <!-- demo dependencies -->
  <script src="bpmn-io-dist/jquery.js"></script>

  <!-- viewer -->
  <script src="bpmn-io-dist/bpmn-viewer.js"></script>

  <!-- app -->

  <script>
    var BpmnViewer = window.BpmnJS;
    var viewer = new BpmnViewer({ container: $('#js-canvas'), height: 600 });
    function log(str) {
      var console = $('#js-console');
      console.val(console.val() + str + '\n');
    }
    function openFromUrl(url) {
      log('attempting to open <' + url + '>');
      $.ajax(url, { dataType : 'text' }).done(function(xml) {
        viewer.importXML(xml, function(err) {
          if (err) {
            log('error: ' + err.message);
            console.error(err);
          } else {
            viewer.get('canvas').zoom('fit-viewport');
            log('success');
          }
        });
      });
    }
    $('#js-open').click(function() {
      var url = $('#js-url').val();
      openFromUrl(url);
    });
    ///// auto open ?url=diagram-url ///////////////////////
    (function() {
      var str = window.location.search;
      var match = /(?:\&|\?)url=([^&]+)/.exec(str);
      if (match) {
        var url = decodeURIComponent(match[1]);
        $('#js-url').val(url);
        openFromUrl(url);
      }
    })();
  </script>

<script>
openFromUrl(document.getElementById("js-url").value);
</script>

</html>