<table>
    <thead>
        <tr>

            <?php foreach($roles as $role):?>
            <th class="rolename px-2 text-center"><?=$role->name?></th>
            <?php endforeach;?>
        </tr>
    </thead>
    <tbody>

            <?php $role_arr = preg_split ("/,/", $user->role);  ?>
            <?php foreach($roles as $role):?>
            <th class="text-center"><input name="<?=$role->name?>" class="role" type="checkbox"
                    <?php if(in_array($role->name,$role_arr)){ echo(" checked");}?>></th>
            <?php endforeach;?>
        </tr>

    </tbody>
</table>

</div>












