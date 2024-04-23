import React from "react";
import {getAsset} from '../utils/Asset'
import {Link} from "react-router-dom";

interface LangProps {
    id: number;
    name: string;
    url: string;
    img: string;
}

class ImageCard extends React.Component<LangProps> {
    render() {
        return (
            <div className="col-lg-4 col-md-6 col-sm-6 portfolio-item" data-aos="zoom-in">
                <div className="portfolio-wrap">
                    <figure>
                        <img src={getAsset(this.props.img)} className="img-fluid" alt=""/>
                    </figure>
                    <div className="portfolio-info">
                        <h4>
                            <Link to={`${this.props.url}`}>{this.props.name}</Link>
                        </h4>
                    </div>
                </div>
            </div>
        );
    }
}

export default ImageCard;