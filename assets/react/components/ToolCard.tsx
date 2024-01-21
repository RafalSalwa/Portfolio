import React from "react";
import {getAsset} from "../utils/Asset";

export enum Sizes {
    Small = "col-lg-3 col-md-3",
    Medium = "col-lg-4 col-md-4",
    Large = "col-lg-6 col-md-6",
}

interface ToolCardProps {
    id: number;
    name: string;
    url: string;
    img: string;
    description: string;
    size: Sizes
}

const ToolCard: React.FC<ToolCardProps> = ({
                                               id = 1,
                                               name = "empty",
                                               img = "empty.png",
                                               url = "localhost",
                                               description = "lorem ipsum sir dolor amet",
                                               size = Sizes.Medium
                                           }) => {
    return (
        <div className={`${size} mb-5`} key={id}>
            <div className="tech-item box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                <h2 className="my-3">{name}</h2>
                <img src={getAsset('techs/' + img)} alt="swagger-logo"
                     className="mb-5"/>
                <div className="d-block my-2 tool-description">
                    {description}
                </div>
                <div className="btn-wrap pt-5">
                    <a href={url} target="_blank"
                       className="btn-buy">Check</a>
                </div>
            </div>
        </div>
    );
}

ToolCard.defaultProps = {
    id: 1,
    name: "default",
    url: "localhost",
    img: "empty.png",
    description: "lorem ipsum",
    size: Sizes.Medium
}
export default ToolCard;