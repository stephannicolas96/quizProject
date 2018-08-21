<div class="modal" id="logoutModal">
    <div class="modal-dialog">
        <div class="modal-content container-fluid">
            <!-- Modal Header -->
            <div class="modal-header d-block text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title large-font">Logout</h4>   
            </div>
        </div>
    </div> 
</div>
<script><?php
if (!empty($_POST) && isset($_POST['logout'])) {
    echo '$(\'#logoutModal\').modal(\'show\')';
    if (session_status() != PHP_SESSION_NONE) {
        session_unset();
        session_destroy();
    }
    unset($_POST);
}
?></script>