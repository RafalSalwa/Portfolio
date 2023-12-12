import React, {useEffect, useState} from 'react';
import axios from 'axios';

function AppList() {
    const [users, setUsers] = useState([]);
    console.log("A")
    useEffect(() => {
        axios.get('/langs/list')
            .then(response => {
                setUsers(response.data);
                console.log(response.data)
            });
    }, []);

    return (
        <div>
            {users.map(user => <div key={user.id}>{user.name}</div>)}
        </div>
    );
}

export default AppList;