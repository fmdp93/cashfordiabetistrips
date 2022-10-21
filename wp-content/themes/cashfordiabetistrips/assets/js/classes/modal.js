class Modal {
  id;
  display_state;

  constructor(id, display_state) {
    this.id = id;
    this.display_state = display_state;
  }

  showModal() {    
    $(`#${this.modal_id}`).modal(this.display_state);
  }
}
