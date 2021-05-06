@extends('layouts.app')

@section('content')
<div>
    <div id="adminCarsRoot"></div>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <script src="https://unpkg.com/react@17/umd/react.production.min.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js" crossorigin></script>
    <script type="text/babel">
        const Page = (props) => {
            const [cars, setCars] = React.useState([]);

            React.useEffect(() => {
                setCars(props.cars.map(x => ({...x, checked: false})))
            },[props.cars])

            const carForEdit = cars.find(x => x.checked);

        return <div className="container">
                <div className="row no-gutters justify-content-between mb-3">
                <div className="d-flex align-items-center btn"><div onClick={() => window.location = "/admin"} className="mr-3">←</div><h3 className="mb-0">Cars</h3></div>

                    <div className="d-flex">
                        <a href="/admin/cars/new"><button className="btn btn-primary mr-2 px-3">Add new car</button></a>
                        <a href={`/admin/cars/${carForEdit ? carForEdit.id : -1}`}><button disabled={!(cars.filter(x => x.checked).length === 1)} className="btn btn-success mr-2 px-4">Edit</button></a>
                        <form action="/deleteCars" method="POST">
                            @csrf</input>
                            <input type="hidden" name="ids" value={cars.filter(x => x.checked).map(x => x.id)}/>
                            <button type="submit" disabled={cars.filter(x => x.checked).length === 0} className="btn btn-danger px-4">Delete</button>
                        </form>
                        <a></a>
                    </div>
                </div>
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th><input onClick={() => setCars(prev => prev.map(x => ({...x, checked: cars.length ? !cars[0].checked : false})))} type="checkbox" checked={cars.filter(x => !x.checked).length === 0 }/></th>
                            <th scope="col">ID</th>
                            <th scope="col">Model</th>
                            <th scope="col">Year</th>
                            <th scope="col">Status</th>
                            <th scope="col">Reg. date</th>
                            <th scope="col"> Pay per min</th>
                            <th scope="col">Number plate</th>
                            <th scope="col">Maintain end</th>
                            <th scope="col">Insur. end</th>
                            <th scope="col">Reg. certificate nr</th>
                        </tr>
                    </thead>
                    <tbody>
                        {cars.map((car, i) => <tr key={`row-${i}`}>
                            <th><input onClick={() => setCars(prev => {
                                let arr = [...prev];
                                arr[i].checked = !arr[i].checked;
                                return arr;
                            })} type="checkbox" checked={car.checked}/></th>
                            <th>{car.id}</th>
                            <td>{car.model}</td>
                            <td>{car.year}</td>
                            <td>{car.status}</td>
                            <td>{car.registration_date}</td>
                            <td>{car.pay_per_minute}</td>
                            <td>{car.number_plate}</td>
                            <td>{car.maintenance_end}</td>
                            <td>{car.insurance_end}</td>
                            <td>{car.registration_certificate_number}</td>
                        </tr>)}
                    </tbody>
                </table>
            </div>
    }
    ReactDOM.render(<Page cars={<?php echo $cars; ?>}/>, document.getElementById("adminCarsRoot"))
    </script>
</div>

@endsection
