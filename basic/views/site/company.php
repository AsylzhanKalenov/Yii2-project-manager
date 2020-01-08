<?php

/* @var $this yii\web\View */


$this->title = 'Profil';
//$this->params['breadcrumbs'][] = $this->title;
$id_userrr = Yii::$app->user->identity->id;


use app\models\ICompany;
use app\models\User;use yii\helpers\Html;
use yii\helpers\Url;

$com=ICompany::find()->where(['id'=>Yii::$app->user->identity->id_company])->one();
$use = User::find()->where(['id_company'=>$com["id"]])->all();


?>
<div class="showEdit" style="display: none; position: absolute; left: 25%; top: 15%; width: 500px; height: 260px; background-color: whitesmoke; z-index: 1000; border: 1px solid #343a40;">
    <input type="hidden" value="0" id="id_us">
    <table style="margin: 20px; width: 100%;">

        <tr>
            <td>Position:</td>
            <td style="width: 70%;">
                <select class="form-control" id="sel1" name="sellist1" style="width: 60%;">
                    <option value="2">Administrator</option>
                    <option value="0">Employee</option>
                </select>

            </td>
        </tr>

    </table>
    <div class="form-group">
        <input type="button" onclick="edit()" value="Save" class="btn btn-primary">

        <input type="button" onclick="closeEdit()" value="Cancel" class="btn btn-danger">
    </div>
</div>



    <img src="/basic/web/uploads/<?=$com["logo"]?>" style="margin-top:20px; height: 150px;" class="avatar img-circle" alt="avatar">
<h2><?=$com["name"]?></h2>
<p><?=$com["description"]?></p>

<div >
    <table class="table">
        <tr ondblclick="showEdit()">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
        </tr>
    <?
    $i=0;
    foreach($use as $u){
        $i++;

        echo "<tr ondblclick='showEdit(".$u["id"].")'><td scope='col'>".$i."</td><td>".$u["name"]."</td><td> ".$u["surname"]."</td><td> ".$u["email"]."</td></tr>";
    }
    ?>
    </table>
</div>

<?= Html::a('Add employee', Url::to(['auth/registr', 'ad'=>0, 'id_company'=>$com["id"]]), ['class' => 'btn btn-warning']) ?>

<script>
    function showEdit(id) {
    $('.showEdit').show();
    $('#id_us').val(id);
    }
    function closeEdit() {
        $('.showEdit').hide();
        $('#id_us').val(0);
    }

        function edit(){
            var data = 'do=edit_pos&id_us=' + $('#id_us').val() + '&pos=' + $('#sel1').val();

            $.ajax({
                url: 'index.php?r=site/company',
                type: 'POST',
                data: data,
                success: function (res) {
                    alert(res);
                },
                error: function () {
                    alert('Error!');
                }
            });
            return false;
        }


</script>
