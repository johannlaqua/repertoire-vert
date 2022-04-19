import React, {Component} from "react";
import ReactDOM from "react-dom";


class ActivationCompte extends Component {
    constructor(props) {
        super(props);
        this.state = { users: [], loading: true};
    }

   getDataUser() {

        if(getUser)
        {
            $.ajax({
                method: "POST",
                url: "https://gaea21user.sustlivprogram.org/apictrl/confirm/"+ token,
                dataType:"",
                success: function(response){
            console.log(response);

        }
        });

        }
        else
        {

        }
    }

    activationUsers(id) {

    }

    render() {
        return (

            <table className="table" id="tableauUser">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Prénom</th>
                    <th>Email</th>
                </tr>
                </thead>

                <tbody>
                { this.state.users.map(user =>(
                <tr>
                    <td>{user.id}</td>
                    <td>{user.username}</td>
                    <td>{user.email}</td>
                    <td>
                        <button type="button" className="btn btn-dark" onClick="alert('Compte activé');">Activer le compte</button>
                    </td>
                </tr>

                ))}
                </tbody>
            </table>

        )
    }
}

ReactDOM.render(<ActivationCompte />, document.getElementById('activation_compte'));