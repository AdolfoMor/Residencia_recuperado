<template lang="pug">
#exampleModal.modal.fade(tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true')
  .modal-dialog(role='document')
    .modal-content
      .modal-header
        h5#exampleModalLabel.modal-title Modal title
        button.close(type='button' data-dismiss='modal' aria-label='Close')
          span(aria-hidden='true') &times;
      .modal-body
        | ...
      .modal-footer
        button.btn.btn-secondary(type='button' data-dismiss='modal') Close
        button.btn.btn-primary(type='button') Save changes
</template>