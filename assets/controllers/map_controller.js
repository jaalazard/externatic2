import { Controller } from '@hotwired/stimulus';
import L from "leaflet";

export default class extends Controller {
   static targets = ['jobOffer']; // eslint-disable-line

    connect() {
        let map = L.map('map').setView([45, 1], 6);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
       maxZoom: 19,
       attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
   }).addTo(map);
   
   for(let jobOffer of this.jobOfferTargets){
    let marker = L.marker([jobOffer.dataset.latitude, jobOffer.dataset.longitude]).addTo(map);
   }
     }
}