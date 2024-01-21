import React from "react";
import {getAsset} from '../utils/Asset'

interface LangProps {
    id: number;
    name: string;
    img: string;
}

class ImageCard extends React.Component<LangProps> {
    render() {
        return (
            <div className="col-lg-4 aos-init aos-animate" data-aos="fade-right"
                 key={this.props.id}>
                <a href={`/react/${this.props.name}`}>
                    <div className="image text-center">
                        <img src={getAsset(this.props.img)}
                             className="img-fluid" alt="golang"></img>
                    </div>
                </a>
            </div>
        )
            ;
    }
}

export default ImageCard;