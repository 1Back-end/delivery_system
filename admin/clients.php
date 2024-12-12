<?php include_once("../menu/menu.php");?>
<?php include_once("../database/database.php");?>
<?php include_once("../fonction/fonction.php");?>

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
        <?php $total_customer = get_count_sender_and_receiver($pdo);?>
        <h5 class="text-uppercase font-14">Liste des clients (<?php echo $total_customer;?>)</h5>
        </div>
    </div>


<div class="col-md-12 col-sm-12 mb-3">
<div class="card-box p-3">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Role</th>
                    <th>Crée le</th>
                </tr>
            </thead>
            <tbody>
                <?php $all_sender_and_receivers = get_all_receiver_and_sender($pdo); ?>
                <?php if(empty($all_sender_and_receivers)):?>
                    <tr>
                        <td colspan="10">Aucun élément trouvé</td>
                    </tr>
                <?php else:?>
                    <?php foreach($all_sender_and_receivers as $index => $user):?>
                        <tr>
                            <td><?php echo ($index + 1); ?></td>
                            <td>
                                    <?php if(empty($user["photo"])): ?>
                                        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg" alt="Photo User" class='rounded-circle img-fluid me-2' width='40' height='40' style='object-fit: cover; width: 40px; height: 40px; max-width: 40px; max-height: 40px;'>
                                    <?php else: ?>
                                        <img src="../uploads/users/<?= htmlspecialchars($user['photo'])?>" class='rounded-circle img-fluid me-2' alt="Photo User" width='40' height='40' style='object-fit: cover; width: 40px; height: 40px; max-width: 40px; max-height: 40px;'>
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
                            </td>
                            <td>
                                        <?php if($user['role'] == 'expediteur') :?>
                                            <span class="badge badge-success disabled btn-rounded">Expéditeur</span>
                                        <?php else:?>
                                            <span class="badge badge-info disabled btn-rounded">Destinataire</span>
                                        <?php endif; ?>
                            </td>
                            <td><?php echo date('d-m-Y H:i:s',strtotime($user['created_at']))?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>
</div>


</div>