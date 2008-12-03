<?php
$title = 'Data Sources - ' . $sourceName . ':' . $table;
$selectedNav = 'database';
include_once($viewsDir . 'common/header.php');
?>

<h1>Table: <strong><?php echo $table;?></strong></h1>
<h2>Source: <a href="<?php echo $controller->urlToMethod('showSource',$sourceName); ?>"><?php echo $sourceName;?></a></h2>
<h2>Columns:</h2>

<table>
<thead>
	<tr>
		<td>Primary</td>
		<td>Column Name</td>
		<td>Type</td>
		<td>Nullable</td>
		<td>Default Value</td>
	</tr>
</thead>
<tbody>
<?php 
$i = 0;
foreach($columns as $column): 
$i++;
if($i % 2 == 0) {
	echo '<tr class="light">';
} else {
	echo '<tr>';
}
?>
		<td><?php echo $column->primaryKey ? 'Yes' : ''; ?></td>
		<td><?php echo $column->name; ?></td>
		<td><?php echo $column->type; ?></td>
		<td><?php echo $column->nullable ? 'Y' : 'N'; ?></td>
		<td><?php echo $column->defaultValue == '' ? 'N/A' : $column->defaultValue; ?></td>
	</tr>
<?php endforeach ?>
</tbody>
</table>
<hr />
<h3><a href="<?php echo $controller->urlToMethod('emptyTable',$sourceName,$table); ?>">Empty Table</a> - <a href="<?php echo $controller->urlToMethod('dropTable', $sourceName, $table); ?>">Drop Table</a></h3>
<?php include_once($viewsDir . 'common/footer.php'); ?>