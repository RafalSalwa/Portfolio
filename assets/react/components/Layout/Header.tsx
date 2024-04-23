import React from 'react';
import {getAsset} from "../../utils/Asset";

const Header: React.FC = () => {

    return (
        <header id="header" className="d-flex align-items-center fixed-top">
            <div className="container d-flex align-items-center justify-content-between">

                <div className="logo">
                    <a href="/">
                        <img src={getAsset('img/logo_white.png')} alt=""
                             className="img-fluid"></img>
                    </a>
                </div>

                <nav id="navbar" className="navbar">
                    <ul>
                        <li><a className="nav-link scrollto active" href="/ux/">Home</a></li>
                        <li><a className="nav-link scrollto" href="/ux/stack">Stack</a></li>
                        <li><a className="nav-link scrollto" href="#contact">Contact</a></li>
                    </ul>
                    <i className="bi bi-list mobile-nav-toggle"></i>
                </nav>

            </div>
        </header>
    );
}

export default Header;