import { Controller } from '@hotwired/stimulus';
import $ from 'jquery';

export default class extends Controller {
   static targets = ['numeroexpedienteInput', 'descripcionInput', 'tipoInput','fechaInicioInput', 'fechaFinInput', 'departamentoInput', 'dniInput', 'solicitanteInput', 'finalizadoInput'];
   static values = {
   };

   clean(event) {
      if (this.numeroexpedienteInputTarget) {
         $(this.numeroexpedienteInputTarget).val('');
      }
      if (this.descripcionInputTarget) {
         $(this.descripcionInputTarget).val('');
      }
      if (this.tipoInputTarget) {
         $(this.tipoInputTarget).val('');
      }
      if (this.fechaInicioInputTarget) {
         $(this.fechaInicioInputTarget).val('');
      }
      if (this.fechaFinInputTarget) {
         $(this.fechaFinInputTarget).val('');
      }
      // if (this.departamentoInputTarget) {
      //    $(this.departamentoInputTarget).val('');
      // }
      if (this.dniInputTarget) {
         $(this.dniInputTarget).val('');
      }
      if (this.solicitanteInputTarget) {
         $(this.solicitanteInputTarget).val('');
      }
      if (this.finalizadoInputTarget) {
         $(this.finalizadoInputTarget).val('');
      }
   }
}