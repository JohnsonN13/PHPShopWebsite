<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;port=8889;dbname=borntoride;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM tasks ORDER BY id');

$nbtasks = $bdd->query('SELECT COUNT(*) AS nbt FROM tasks');
$count = $nbtasks->fetch();

$tasksok = $bdd->query('SELECT COUNT(*) AS nb FROM tasks WHERE etat = "Réussi"');
$count1 = $tasksok->fetch();

$count2 = $count["nbt"] - $count1["nb"];

if(isset($_POST["submit"])) {

    $description = $_POST["desc"];
    $etat = $_POST["etat"];

    $request = $bdd->prepare('INSERT INTO tasks VALUES (:id, :desc, :etat)');
    $request->execute(array(":id" => null, "desc" => $description, "etat" => $etat));
}
if(isset($_POST["update"])) {

    $request = $bdd->prepare('UPDATE tasks SET etat = :etat WHERE id = :id');
    $request->execute(array("etat" => $_POST["etatup"], "id" => $_GET["id"]));
}
?>

<div id="manage">

    <div class="manage-title">
        <h3> Informations du site </h3>
    </div>

    <div class="row manage-body">
        <div class="managechart col-md-6">
            <canvas id="chart"></canvas>

            <script type="text/javascript">
            var ctx = document.getElementById('chart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['semaine 0', 's1', 's2', 's3', 's4', 's5'],
                    datasets: [{
                        label: 'Contributions',
                        data: [0, 6, 1, 0, 10, 0, 0],
                        borderColor: 'rgb(129, 194, 43)',
                    }]
                }
            });
            </script>
        </div>

        <div class="manageprog col-md-5">
            <h4> Etat des tâches et des produits </h4>

            <div class="myrow2">
                <p> Tâches accomplies :  <?php echo $count1["nb"] ?> / <?php echo $count["nbt"] ?></p>
            </div>
            <div class="progress">
                <?php 
                    $res = ($count1["nb"]/$count["nbt"])*100;
                ?>
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $res ?>%"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="myrow2">
                <p> Tâches en attente : <?php echo $count2 ?> / <?php echo $count["nbt"] ?></p>
            </div>
            <div class="progress">
                <?php 
                    $res2 = 100 - $res;
                ?>
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $res2 ?>%" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>

            <div class="myrow2">
                <p> Produits actifs </p>
            </div>
            <div class="progress">

                <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="myrow2">
                <p> Produits Inactifs </p>
            </div>
            <div class="progress">

                <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>

<div id="tasks" class="div-manage">
    
    <table class="table">
        <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Description de la tâche</th>
                <th scope="col">Etat</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
                foreach ($reponse as $task)
                {
            ?>
            <tr class="<?php 
                if ($task["etat"] === "Réussi") { echo "table-success"; }
                else { 
                    if ($task["etat"] === "En cours") { echo "table-warning"; } 
                    else { echo "table-danger"; }
                } ?>">

                <th scope="row">
                    <?php echo $task["id"] ?>
                </th>
                <td>
                    <?php echo $task["description"] ?>
                </td>
                <td>
                    <?php echo $task["etat"] ?>
                </td>
                <td>
                    <form action="admin.php?updated&id=<?php echo $task["id"];?>" method="post">
                        <div class="div-form">
                            <select name="etatup" class="form-control col-md-4">
                                <option disabled selected>Etat</option>
                                <option value="Réussi">Réussi</option>
                                <option value="En cours">En cours</option>
                                <option value="En attente">En attente</option>
                            </select>
                            <button type="submit" class="btn-warning form-control col-md-4" name="update">Modifier</button>
                        </div>
                    </form>
                </td>
            </tr>

            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<div id="addtable" class="div-manage">
    <form action="admin.php" method="post">

        <div class="myrow">
            <div class="title col-md-3">
                <h4> Ajouter une tâche </h4>
            </div>

            <div class="form-group col-md-3">
                <label>Description</label>
                <input type="text" class="form-control" name="desc" placeholder="Description" required pattern="[A-Za-z '^]*">
            </div>
            <div class="form-group col-md-3">
                <label>Etat</label>
                <input type="text" class="form-control" 
                    placeholder="ex: Réussi / En cours / En attente" name="etat" required pattern="Réussi|En cours|En attente">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn form-control submitbtn" name="submit">Ajouter</button>
            </div>
        </div>  
   
    </form>
</div>