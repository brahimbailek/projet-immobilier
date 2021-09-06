<?php

require_once '../view/ViewTemplate.php';
require_once '../view/ViewTypeBiens.php';

ViewTemplate::baliseTop();

ViewTypeBiens::listeTypeBiens('a');

?>


<?php

ViewTemplate::baliseBottom();
?>