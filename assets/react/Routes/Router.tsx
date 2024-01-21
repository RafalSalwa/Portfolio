import React from 'react';
import {BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import Home from "../pages/Home";
import Apps from "../pages/Apps";
import Tools from "../pages/Tools";

export function ApplicationRouter() {
    return (
        <Router>
            <Routes>
                <Route path="/react" element={<Home/>} handle={{crumb: () => "Home"}}/>
                <Route path="/react/:lang" element={<Apps/>} handle={{crumb: () => "Apps"}}/>
                <Route path="/react/:lang/:app" element={<Tools/>} handle={{crumb: () => "Stack"}}/>
            </Routes>
        </Router>
    );
}
