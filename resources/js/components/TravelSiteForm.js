import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FormMap from './FormMap';

export class TravelSiteForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      name : "",
      address : "",
      travel_type_id : '',
      photo : '',
      description : '',
      latitude : 0,
      longitude : 0,
      types : []
    }

    this.getTypes = this.getTypes.bind(this);
    this.onChange = this.onChange.bind(this);
  }

  getTypes() {
    axios.get('/api/types').then(resp => {
      this.setState({ types : resp.data });
    });
  }

  componentDidMount() {
    this.getTypes();
  }

  onChange(ev) {
    this.setState({
      [ev.target.name] : ev.target.value
    })
  }

  render() {
    const {name, address, description, travel_type_id} = this.state;
    return (
      <Fragment>
        <div className="row">
          <div className="col-md-6">
          <form action="" encType="multipart/form-data" method="post">
              <label htmlFor="" className="control-label mb-1 mt-1">Nama tempat wisata</label>
              <input type="text" onChange={this.onChange} value={name} name="name" placeholder="Nama tempat wisata" className="form-control" />
              <label htmlFor="" className="control-label mb-1 mt-1">Alamat tempat wisata</label>
              <input type="text" onChange={this.onChange} value={address} name="address" placeholder="Alamat tempat wisata" className="form-control" />
              <label htmlFor="" className="control-label mb-1 mt-1">Tipe wisata</label>
              <select name="travel_type_id" onChange={this.onChange} value={travel_type_id} id="" className="form-control">
                <option value="">Pilih tipe wisata</option>
                { this.state.types.map((type, i) => (<option key={i} value={type.id}>{type.name}</option>)) }
              </select>
              <label htmlFor="" className="control-label mb-1 mt-1">Gambar tempat wisata</label>
              <input type="file" name="photo[]" onChange={this.onChange} value={this.state.photo} multiple={true} accept="image/*" className="form-control" id="" />
              <label htmlFor="" className="control-label mb-1 mt-1">Deskripsi tempat wisata</label>
              <textarea name="description" onChange={this.onChange} value={description} rows="5" placeholder="Deskripsi" className="form-control" />
              <hr />
              <button type="submit" className="btn btn-outline-success btn-sm">Buat</button>
            </form>
          </div>
          <div className="col-md-6">
            <FormMap onCoordChange={({latitude, longitude}) => this.setState({ latitude, longitude })} />
          </div>
        </div>
      </Fragment>
    )
  }
}

if (document.getElementById('travel-form')) {
  ReactDOM.render(<TravelSiteForm />, document.getElementById('travel-form'));
}