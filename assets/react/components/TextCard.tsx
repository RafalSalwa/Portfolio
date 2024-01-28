import React from "react";
import {getAsset} from "../utils/Asset";

export enum Sizes {
    Small = "col-lg-3 col-md-3",
    Medium = "col-lg-4 col-md-4",
    Large = "col-lg-6 col-md-6",
}

interface TextCardProps {
    id: number;
    name: string;
    img: string;
    url: string;
    size: Sizes
}

const TextCard: React.FC<TextCardProps> = ({id = 1, name = "empty", img = "empty.png", size = Sizes.Medium}) => {

    return (
        <div className="col-lg-4 col-md-6 portfolio-item filter-app">
            <div className="portfolio-wrap">
                <img src={getAsset(img)} className="img-fluid"
                     alt=""/>
                <div className="portfolio-info">
                    <h4>AuthApi</h4>
                    <div className="portfolio-links">
                        <a href={name} title="More Details">
                            <i className="bx bx-link">tools</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

TextCard.defaultProps = {
    id: 1,
    name: "default",
    img: "empty.png",
    size: Sizes.Medium
}
export default TextCard;