<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>


<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mr-auto">
                    <?php $count_users = get_count_admins($pdo);?>
                    <h5 class="text-uppercase font-14">Liste des utilisateurs (<?php echo $count_users;?>)</h5>
                </div>
                <div class="ml-auto">
                    <a href="" class="btn btn-customize text-white text-uppercase">
                        Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php $all_users = get_all_users_admin($pdo)?>
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <?php if(!empty($_GET["message"])) : ?>
                <?php $message = $_GET["message"]; ?>
                <span class="text-info"><?php echo $message; ?> !</span>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>N° Téléphone</th>
                            <th>Statut</th>
                            <th>Ajouté le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if(empty($all_users)): ?>
                        <tr>
                            <td colspan="10">Aucun enregistrement trouvé</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach($all_users as $index => $user):?>
                            <tr>
                                <td><?php echo ($index + 1); ?></td>
                                <td>
                                    <?php if(empty($user["photo"])): ?>
                                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" class="img-fluid" alt="Photo User" width='40' height='40' style='object-fit: cover; width:40px; height: 40px; max-width: 40px; max-height: 40px;' class="rounded-circle mr-2">
                                    <?php else: ?>
                                        <img src="../uploads/admin/<?= htmlspecialchars($user['photo'])?>" class="img-fluid" alt="Photo User" width='40' height='40' style='object-fit: cover; width:40px; height: 40px; max-width: 40px; max-height: 40px;' class="rounded-circle mr-2">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($user['email'])?></td>
                                <td>
                                    <?php if(empty($user['phone_number'])):?>
                                        <span>Non renseigné</span>
                                    <?php else:?>
                                        <?php echo htmlspecialchars($user["phone_number"])?>
                                    <?php endif; ?>
                                    <td>
                                        <?php if($user['is_active'] == 0) :?>
                                            <span class="badge badge-success disabled btn-rounded">Actif</span>
                                        <?php else:?>
                                            <span class="badge badge-danger disabled btn-rounded">Inactif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo date('d-m-Y H:i:s',strtotime($user['created_at']))?></td>
                                    <td>
                                    <div class="dropdown">
                                    <button class="btn btn-customize text-white btn-rounded dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i> <!-- Trois points pour le menu -->
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?php if($user['is_active']==0): ?>
                                            <li><a class="dropdown-item text-warning" href="deactivate_user.php?user_uuid=<?php echo $user['uuid']; ?>">
                                            <i class="fa fa-toggle-on text-warning"></i> Désactiver
                                        </a></li>
                                        <?php else: ?>
                                            <li><a class="dropdown-item text-success" href="activate_user.php?user_uuid=<?php echo $user['uuid']; ?>">
                                            <i class="fa fa-toggle-on text-success"></i> Activer
                                        </a></li>
                                        <?php endif;?>

                                        <li><a class="dropdown-item text-danger" href="delete_user.php?user_uuid=<?php echo $user['uuid']; ?>">
                                            <i class="fa fa-trash-o"></i> Supprimer
                                        </a></li>
                                    </ul>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>