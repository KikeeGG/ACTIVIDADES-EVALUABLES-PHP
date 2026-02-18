<?php // Formulario para editar alumno ?>

<h2>Editar alumno</h2>

<?php if (!empty($error)): ?>
    <div style="color:red; padding:5px; border:1px solid red; margin-bottom:10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="POST" action="index.php?accion=actualizar">
    <input type="hidden" name="id" value="<?= $alumno->id ?>">

    <label>Nombre</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($alumno->nombre) ?>" required><br><br>

    <label>Email</label><br>
    <input type="text" name="email" value="<?= htmlspecialchars($alumno->email) ?>"><br><br>

    <label>Edad</label><br>
    <input type="text" name="edad" value="<?= $alumno->edad ?>" required><br><br>

    <button type="submit">Actualizar alumno</button>
</form>