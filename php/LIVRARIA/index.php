<?php
$mysqli = mysqli_connect('localhost','root','Charlo2025@','Livraria');
$columns = array('Titulo','Quantidade','Genero','Preco');

$column = isset($_GET['column']) && in_array($_GET['column'],$columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $mysqli->query('SELECT * FROM livros ORDER BY ' . $column . ' ' . $sort_order)) {
    $up_or_down = $sort_order == 'ASC' ? 'up' : 'down';
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    $add_class = ' class="highlight"';
?>
<table>
    <tr>
        <th><a href="index.php?column=Titulo&order=<?php echo $asc_or_desc; ?>">Título <?php echo $column == 'Titulo' ? '-' . $up_or_down : ''; ?></a></th>
        <th><a href="index.php?column=Quantidade&order=<?php echo $asc_or_desc; ?>">Quantidade <?php echo $column == 'Quantidade' ? '-' . $up_or_down : ''; ?></a></th>
        <th><a href="index.php?column=Genero&order=<?php echo $asc_or_desc; ?>">Genero <?php echo $column == 'Genero' ? '-' . $up_or_down : ''; ?></a></th>
        <th><a href="index.php?column=Preco&order=<?php echo $asc_or_desc; ?>">Preço <?php echo $column == 'Preco' ? '-' . $up_or_down : ''; ?></a></th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td <?php echo $column == 'Titulo' ? $add_class : ''; ?>><?php echo $row['Titulo']; ?></td>
        <td <?php echo $column == 'Quantidade' ? $add_class : ''; ?>><?php echo $row['Quantidade']; ?></td>
        <td <?php echo $column == 'Genero' ? $add_class : ''; ?>><?php echo $row['Genero']; ?></td>
        <td <?php echo $column == 'Preco' ? $add_class : ''; ?>><?php echo $row['Preco']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php
    $result->free();
}
?>
