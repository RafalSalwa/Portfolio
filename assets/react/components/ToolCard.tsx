import React from "react";
import {getAsset} from "../utils/Asset";
import {Link} from "react-router-dom";

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
}

const ToolCard: React.FC<ToolCardProps> = ({
                                               id = 1,
                                               name = "empty",
                                               img = "empty.png",
                                               url = "localhost",
                                               description = "lorem ipsum sir dolor amet",
                                           }) => {
    return (
        <div className="col-lg-3 col-md-4 wow fadeInUp animated" key={id}>
            <div className="about-col">
                <div className="img d-flex align-items-center text-center">
                    <img src={getAsset('img/techs/' + img)} alt={name + '-logo'}
                         className="img-fluid mx-auto d-block"/>
                </div>
                <h2 className="title border-top mt-4 pt-3 mx-3">
                    <Link to={url} target="_blank">{name}</Link>
                </h2>
                <p>
                    {description}
                </p>
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
}
export default ToolCard;