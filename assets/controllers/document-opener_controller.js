import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
   static targets = [];
   static values = {};

   async open(event) {
      event.preventDefault();
      const url = this.element.href;
      fetch(this.element.href).then(function (response) {
         if (response.ok) {
            document.location.href=url;
         } else {
            import ('sweetalert2').then(async(Swal) => {
               Swal.default.fire({
                  template: '#warning-html'
               });
         });            
      }});
   }
}