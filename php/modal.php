<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Conferma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler uscire?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-color-2 text-white rounded" data-dismiss="modal">Annulla</button>
        <form  action="./logout.php" method="post">
          <button  type="submit" class="btn bg-color-1 text-white rounded">Si</button>
        </form>
      </div>
    </div>
  </div>
</div>
