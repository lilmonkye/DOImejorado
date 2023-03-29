import './bootstrap';

import 'jquery-ui/ui/widgets/datepicker.js';

$(document).ready(function() {
  $('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
  });
});
