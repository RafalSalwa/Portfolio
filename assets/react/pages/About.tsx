import React, {useEffect, useState} from 'react';
import {useParams} from "react-router-dom";

interface ToolItem {
    id: number,
    name: string,
    url: string;
    img: string,
    description: string;
}

interface ToolsData {
    tools: ToolItem[];
}

const About: React.FC = () => {
    const params = useParams()
    const [data, setData] = useState<ToolItem[] | null>(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
    }, [data]);

    return (
        <section id="about">
            <div className="container-xxl my-5 mt-15">
                <header className="section-header my-5">
                    <h3 className="section-title my-5">About</h3>
                </header>

                <div className="row about-cols">
                </div>
            </div>
        </section>
    )
}

export default About;