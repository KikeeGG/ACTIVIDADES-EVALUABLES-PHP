<?php // Listado de alumnos ?>
<h2>Listado de alumnos</h2>

<?php if (!empty($mensaje)): ?>
    <div class="ok"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div style="color:red; padding:5px; border:1px solid red; margin-bottom:10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Edad</th>
        <th>Fecha creación</th>
        <th>Acción</th>
    </tr>

    <?php if (!empty($alumnos)): ?>
        <?php foreach ($alumnos as $a): ?>
            <tr>
                <td><?= $a->id ?></td>
                <td><?= htmlspecialchars($a->nombre) ?></td>
                <td><?= htmlspecialchars($a->email) ?></td>
                <td><?= $a->edad ?></td>
                <td>
                    <?= date('d/m/Y H:i', strtotime($a->fecha_creacion)) ?>
                </td>
                <td>
                    <a href="index.php?accion=editar&id=<?= $a->id ?>">
                        Editar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No hay alumnos registrados.</td>
        </tr>
    <?php endif; ?>
</table>