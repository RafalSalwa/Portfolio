import React, {Component} from 'react';
import {Link} from 'react-router-dom';

class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link to={`/`} className={"navbar-brand"}> Symfony React Project </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link to={"/posts"} className={"nav-link"}> Posts </Link>
                            </li>

                            <li className="nav-item">
                                <Link to={"/users"} className={"nav-link"}> Users </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        )
    }
}

export default Home;