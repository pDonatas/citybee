@extends('layouts.app')

@section('content')
<div>
    <div id="adminUsersRoot"></div>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://unpkg.com/react@17/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js" crossorigin></script>
    <script type="text/babel">
        const Page = (props) => {
            const [users, setUsers] = React.useState([]);

            React.useEffect(() => {
                setUsers(props.users.map(x => ({...x, checked: false})))
            },[props.users])

            const getRole = (id) => {
                switch(id)
                {
                    case 0:
                        return "user";
                    case 1:
                        return "support";
                    case 2:
                        return "admin";
                    default:
                        return "";

                }
            }

        return <div className="container">
                <div className="row no-gutters justify-content-between mb-3">
                <div className="d-flex align-items-center btn"><div onClick={() => window.location = "/admin"} className="mr-3">←</div><h3 className="mb-0">Users</h3></div>

                    <div className="d-flex">
                    <form action="/unblockUsers" method="POST">
                            @csrf</input>
                            <input type="hidden" name="ids" value={users.filter(x => x.checked).map(x => x.id)}/>
                            <button type="submit" disabled={users.filter(x => x.checked).length === 0} className="btn btn-success px-4 mr-1">Unblock</button>
                        </form>
                        <form action="/blockUsers" method="POST">
                            @csrf</input>
                            <input type="hidden" name="ids" value={users.filter(x => x.checked).map(x => x.id)}/>
                            <button type="submit" disabled={users.filter(x => x.checked).length === 0} className="btn btn-danger px-4">Block</button>
                        </form>
                        <a></a>
                    </div>
                </div>
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th><input onClick={() => setUsers(prev => prev.map(x => ({...x, checked: users.length ? !users[0].checked : false})))} type="checkbox" checked={users.filter(x => !x.checked).length === 0 }/></th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email verified date</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Is suspended</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        {users.map((user, i) => <tr key={`row-${i}`}>
                            <th><input onClick={() => setUsers(prev => {
                                let arr = [...prev];
                                arr[i].checked = !arr[i].checked;
                                return arr;
                            })} type="checkbox" checked={user.checked}/></th>
                            <th>{user.id}</th>
                            <td>{user.name}</td>
                            <td>{user.surname}</td>
                            <td>{user.email}</td>
                            <td>{user.phone}</td>
                            <td>{user.email_verified_at}</td>
                            <td>{user.created_at.split("T")[0]}</td>
                            <td>{user.is_suspended === 0 ? "No" : "Yes"}</td>
                            <td>{getRole(user.role)}</td>
                        </tr>)}
                    </tbody>
                </table>
            </div>
    }
    ReactDOM.render(<Page users={<?php echo $users; ?>}/>, document.getElementById("adminUsersRoot"))
    </script>
</div>

@endsection
