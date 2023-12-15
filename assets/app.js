// import { registerVueControllerComponents } from '@symfony/ux-vue';
import React from 'react';
import ReactDOM from "react-dom/client";
import './styles/app.css';
import './styles/style.css';
import './vendor/aos/aos.css';
import './vendor/boxicons/css/boxicons.min.css';
import './vendor/glightbox/css/glightbox.min.css';
import './vendor/swiper/swiper-bundle.min.css';

import './vendor/aos/aos';
import './vendor/glightbox/js/glightbox.min';
import './vendor/isotope-layout/isotope.pkgd.min';
import './vendor/php-email-form/validate';
import './vendor/swiper/swiper-bundle.min';

import './scripts/main';
import {RouterProvider} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
import Home from "./react/components/Home";
import {ApplicationRouter} from "./react/router";

// const root = ReactDOM.createRoot(document.getElementById("app-root"));
// root.render(
//     <RouterProvider router={ApplicationRouter}>
//         <React.StrictMode>
//             <Home/>
//         </React.StrictMode>
//     </RouterProvider>
// );

// registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));