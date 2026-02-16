<h2>Listado de alumnos</h2>

<?php if(!empty($mensaje)): ?>
<div class="ok"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>
<?php // Muestra mensaje tras borrar ?>

<table border="1" cellpadding="8">
<tr>
<th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Acción</th>
</tr>
<?php foreach($alumnos as $a): ?>
    <tr>
        <td><?= $a['id'] ?></td>
        <td><?= $a['nombre'] ?></td>
        <td><?= $a['email'] ?></td>
        <td><?= $a['edad'] ?></td>
        <td>
        <!-- Leve uso de JS, "onclick" y su confirmacion -->
        <a href="index.php?accion=borrar&id=<?= $a['id'] ?>"
        onclick="return confirm('¿Estás seguro que quieres borrar los datos?')">

        Borrar

        </a>
        </td>
    </tr>
<?php endforeach; ?>

</table>