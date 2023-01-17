<?php $parentProductName  = $vars['parentProductName']; ?>

<link href="<?= $vars['controller']::TEMPLATE_PATH ?>Styles/bootstrap.min.css" rel="stylesheet">
<link href="<?= $vars['controller']::TEMPLATE_PATH ?>Styles/bootstrap_correction.css" rel="stylesheet">
<link href="<?= $vars['controller']::TEMPLATE_PATH ?>Styles/style.css" rel="stylesheet">

<?php global $fwDevMode; if ($fwDevMode === true) { ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<?php } else { ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<?php } ?>

<div id="app">
</div>

<script src="<?= $vars['controller']::TEMPLATE_PATH ?>Scripts/Basics.js?v=<?=time()?>"></script>
<script src="<?= $vars['controller']::TEMPLATE_PATH ?>Scripts/PaginationView.vue.js?v=<?=time()?>"></script>
<script src="<?= $vars['controller']::TEMPLATE_PATH ?>Scripts/ManufacturerAddressEditLine.vue.js?v=<?=time()?>"></script>
<script src="<?= $vars['controller']::TEMPLATE_PATH ?>Scripts/ManufacturerAddressEdit.vue.js?v=<?=time()?>"></script>
<script src="<?= $vars['controller']::TEMPLATE_PATH ?>Scripts/App.vue.js?v=<?=time()?>"></script>