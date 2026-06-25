import './bootstrap';

import L from 'leaflet';
import 'leaflet/dist/leaflet.css';


// make Leaflet global (important for plugins)
window.L = L;


// import plugin AFTER Leaflet
import 'leaflet-polylinedecorator';
import './SmoothWheelZoom.js';

// optional debug
console.log('Leaflet loaded:', L);
console.log('PolylineDecorator:', L.polylineDecorator);
// import 'leaflet.smoothwheelzoom';
// import '/node_modules/projektpro-leaflet-smoothwheelzoom/Leaflet.SmoothWheelZoom.js';
