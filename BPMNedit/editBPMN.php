<html>
<head>
  <title>bpmn-js modeler demo</title>

  <link rel="stylesheet" href="css/diagram-js.css" />
  <link rel="stylesheet" href="vendor/bpmn-font/css/bpmn-embedded.css" />
  <link rel="stylesheet" href="css/app.css" />
</head>
<body>
  <div class="content" id="js-drop-zone">

    <div class="message intro">
      <div class="note">
        Drop BPMN diagram from your desktop or <a id="js-create-diagram" href>create a new diagram</a> to get started.
      </div>
    </div>

    <div class="message error">
      <div class="note">
        <p>Ooops, we could not display the BPMN 2.0 diagram.</p>

        <div class="details">
          <span>cause of the problem</span>
          <pre></pre>
        </div>
      </div>
    </div>

    <div class="canvas" id="js-canvas"></div>
  </div>

  <ul class="buttons">
    <li>
      download
    </li>
    <li>
      <a id="js-download-diagram" href title="download BPMN diagram">
        BPMN diagram
      </a>
    </li>
    <li>
      <a id="js-download-svg" href title="download as SVG image">
        SVG image
      </a>
    </li>
  </ul>

  <!-- demo dependencies -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

  <!-- viewer -->
  <script src="https://dev-diadikasies.ellak.gr/BPMN/bpmn-io-dist/bpmn-viewer.js"></script>
  <script src="https://dev-diadikasies.ellak.gr/BPMN/bpmn-io-dist/bpmn-modeler.js"></script>

  <!-- app -->


<script>

'use strict';

var fs = require('fs');

var $ = require('jquery'),
    BpmnModeler = require('http://imagnisa.labs.ihu.edu.gr/mw/BPMN/bpmn-io-dist/Modeler');

var container = $('#js-drop-zone');

var canvas = $('#js-canvas');

var modeler = new BpmnModeler({ container: canvas });

var newDiagramXML = fs.readFileSync(__dirname + 'resources/newDiagram.bpmn', 'utf-8');

function createNewDiagram() {
  openDiagram(newDiagramXML);
}

function openDiagram(xml) {

  modeler.importXML(xml, function(err) {

    if (err) {
      container
        .removeClass('with-diagram')
        .addClass('with-error');

      container.find('.error pre').text(err.message);

      console.error(err);
    } else {
      container
        .removeClass('with-error')
        .addClass('with-diagram');
    }


  });
}

function saveSVG(done) {
  modeler.saveSVG(done);
}

function saveDiagram(done) {

  modeler.saveXML({ format: true }, function(err, xml) {
    done(err, xml);
  });
}

function registerFileDrop(container, callback) {

  function handleFileSelect(e) {
    e.stopPropagation();
    e.preventDefault();

    var files = e.dataTransfer.files;

    var file = files[0];

    var reader = new FileReader();

    reader.onload = function(e) {

      var xml = e.target.result;

      callback(xml);
    };

    reader.readAsText(file);
  }

  function handleDragOver(e) {
    e.stopPropagation();
    e.preventDefault();

    e.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
  }

  container.get(0).addEventListener('dragover', handleDragOver, false);
  container.get(0).addEventListener('drop', handleFileSelect, false);
}


////// file drag / drop ///////////////////////

// check file api availability
if (!window.FileList || !window.FileReader) {
  window.alert(
    'Looks like you use an older browser that does not support drag and drop. ' +
    'Try using Chrome, Firefox or the Internet Explorer > 10.');
} else {
  registerFileDrop(container, openDiagram);
}

// bootstrap diagram functions

$(document).on('ready', function() {

  $('#js-create-diagram').click(function(e) {
    e.stopPropagation();
    e.preventDefault();

    createNewDiagram();
  });

  var downloadLink = $('#js-download-diagram');
  var downloadSvgLink = $('#js-download-svg');

  $('.buttons a').click(function(e) {
    if (!$(this).is('.active')) {
      e.preventDefault();
      e.stopPropagation();
    }
  });

  function setEncoded(link, name, data) {
    var encodedData = encodeURIComponent(data);

    if (data) {
      link.addClass('active').attr({
        'href': 'data:application/bpmn20-xml;charset=UTF-8,' + encodedData,
        'download': name
      });
    } else {
      link.removeClass('active');
    }
  }

  var _ = require('lodash');

  var exportArtifacts = _.debounce(function() {

    saveSVG(function(err, svg) {
      setEncoded(downloadSvgLink, 'diagram.svg', err ? null : svg);
    });

    saveDiagram(function(err, xml) {
      setEncoded(downloadLink, 'diagram.bpmn', err ? null : xml);
    });
  }, 500);

  modeler.on('commandStack.changed', exportArtifacts);
});

</script>
</html>
