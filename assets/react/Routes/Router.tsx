import React from 'react';
import {BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import Layout from "../components/Layout/Layout";
import ErrorBoundary from "../components/ErrorBoundary";

const Home = React.lazy(() => import('../pages/Home'));
const Apps = React.lazy(() => import('../pages/Apps'));
const Tools = React.lazy(() => import('../pages/Tools'));
const Contact = React.lazy(() => import('../pages/Contact'));
const About = React.lazy(() => import('../pages/About'));

export function ApplicationRouter() {
    return (
        <Router basename="/react">
            <Routes>
                <Route element={<Layout/>} errorElement={<ErrorBoundary/>}>
                    <Route path="/" element={<Home/>}/>
                    <Route path="/contact" element={<Contact/>}/>
                    <Route path="/about" element={<About/>}/>
                    <Route path="/:lang" element={<Apps/>}/>
                    <Route path="/:lang/:app" element={<Tools/>}/>
                </Route>
            </Routes>
        </Router>
    );
}
