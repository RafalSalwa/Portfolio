import React from 'react';
import {getAsset} from "../../utils/Asset";
import {Link} from "react-router-dom";

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
                        <li><Link to="/" className="nav-link scrollto active">Home</Link></li>
                        <li><Link className="nav-link scrollto" to="/search">Stacks Search</Link></li>
                        <li><Link className="nav-link scrollto" to="/contact">Contact</Link></li>
                    </ul>
                    <i className="bi bi-list mobile-nav-toggle"></i>
                </nav>

            </div>
        </header>
    );
}

export default Header;