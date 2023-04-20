import "./bootstrap";
import "../pace/pace";
import { Carousel, initTE } from "tw-elements";
initTE({
    Carousel,
});

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);
window.Alpine = Alpine;

import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid.css";

Alpine.start();
