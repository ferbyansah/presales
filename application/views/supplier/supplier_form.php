<form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Kode Distributor <?php echo form_error('kode_supplier') ?></label>
            <input type="text" class="form-control" name="kode_supplier" id="kode_supplier" placeholder="Kode Distributor" value="<?php echo $kode_supplier; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Distributor <?php echo form_error('nama_supplier') ?></label>
            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Distributor" value="<?php echo $nama_supplier; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">No Telfon PIC <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Nomor Telfon" value="<?php echo $telp; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Email PIC <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama PIC <?php echo form_error('nama_pic') ?></label>
            <input type="text" class="form-control" name="nama_pic" id="nama_pic" placeholder="Nama PIC" value="<?php echo $nama_pic; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="nama_supplier" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
        <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('supplier') ?>" class="btn btn-default">Cancel</a>
    </form>