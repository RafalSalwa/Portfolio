import React, {useEffect, useState} from 'react';
import axios from 'axios';

function Index() {
    const [users, setUsers] = useState([]);
    useEffect(() => {
        axios.get('/api/users')
            .then(response => {
                setUsers(response.data);
            });
    }, []);

    return (
        <div></div>
    );
}

export default Index;