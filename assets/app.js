import React from 'react';
import ReactDOM from "react-dom/client";
import './styles/app.css';
import {BrowserRouter as Router, RouterProvider} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import Home from "./react/components/Home";
import {ApplicationRouter} from "./react/router";

const root = ReactDOM.createRoot(document.getElementById("app-root"));
root.render(
    <RouterProvider router={ApplicationRouter} />
    <React.StrictMode>
        <Router>
            <Home/>
        </Router>
    </React.StrictMode>
);
