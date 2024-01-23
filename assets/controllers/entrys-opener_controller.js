import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap';
import $ from 'jquery';

export default class extends Controller {
   static targets = ['modal', 'modalBody'];
   static values = {};

   async openModal(event) {
      event.preventDefault();
      this.modalBodyTarget.innerHTML = 'Loading...';
      this.modal = new Modal(this.modalTarget);
      this.modal.show();
      const response = await $.ajax(event.currentTarget.href);
      this.modalBodyTarget.innerHTML = response;
   }
}