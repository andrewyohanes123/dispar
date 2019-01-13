import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FormMap from './FormMap';
import UploadingModal from './UploadingModal';
import baseurl from './BaseURL';

export class TravelSiteEdit extends Component {
  constructor(props) {
    super(props);

    this.state = {
      name: "",
      address: "",
      travel_type_id: '',
      photo: [],
      files: [],
      description: '',
      latitude: 0,
      longitude: 0,
      types: [],
      errors: [],
      progress: 0,
      site_pictures: []
    }

    this.getTypes = this.getTypes.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onFileSelected = this.onFileSelected.bind(this);
    this.onFileSelect = this.onFileSelect.bind(this);
    this.postData = this.postData.bind(this);
    this.getSite = this.getSite.bind(this);
    this.uploadPhoto = this.uploadPhoto.bind(this);
  }

  getTypes() {
    axios.get('/api/types').then(resp => {
      this.setState({ types: resp.data });
    });
  }

  getSite() {
    const id = document.querySelector('meta[name="travel-id"]').content;
    axios.get(`/dashboard/tempat-wisata/${id}/api`).then(resp => {
      const { name, address, description, latitude, longitude, site_pictures, travel_type_id } = resp.data;
      this.setState({ name, address, description, latitude, longitude, site_pictures, travel_type_id });
    });
  }

  componentDidMount() {
    this.getTypes();
    this.getSite();
  }

  onChange(ev) {
    this.setState({
      [ev.target.name]: ev.target.value
    })
  }

  onFileSelected(ev) {
    // console.dir(ev.target.files[0]);
    this.setState({ photo: ev.target.files[0] }, () => this.uploadPhoto());
  }

  uploadPhoto() {
    // e.preventDefault();
    const id = document.querySelector('meta[name="travel-id"]').content;
    const FD = new FormData();
    FD.append('photo', this.state.photo)
    axios.post(`${baseurl}/dashboard/site-picture`, FD, {
      onUploadProgress: progress => this.setState({ progress: Math.round((progress.loaded * 100) / progress.total) }),
      headers: {
        'Content-Type': 'multipart/form-data'
      }, params : {
        id
      }
    }).then(resp => {
      const {site_pictures} = this.state;
      site_pictures.push(resp.data);
      this.setState({ site_pictures, progress : 0 });
    });
  }

  onFileSelect(ev) {
    this.setState({
      photo: ev.target.files[0],
      files: Object.assign(ev.target.files[0], {
        preview: URL.createObjectURL(ev.target.files[0])
      })
    }, () => console.log(this.state.files));
  }

  postData(ev) {
    ev.preventDefault();
    const { name, address, description, travel_type_id, longitude, latitude, photo } = this.state;
    const id = document.querySelector('meta[name="travel-id"]').content;
    // try {
    axios.put(`${baseurl}/dashboard/tempat-wisata/${id}`, { name, address, description, travel_type_id, longitude, latitude }).then(resp => {
      if (resp.data.site) this.setState({ name: '', address: '', description: '', travel_type_id: '', files: [], photo: [] }, () => this.file.value = '');
    }).catch(error => this.setState({ errors: error.response.data.errors }));
  }

  render() {
    const { name, address, description, travel_type_id, errors, latitude, longitude } = this.state;

    return (
      <Fragment>
        <div className="row">
          <div className="col-md-6">
            <form action="" encType="multipart/form-data" method="post">
              <label htmlFor="" className="control-label mb-1 mt-1">Nama tempat wisata</label>
              <input type="text" onChange={this.onChange} value={name} name="name" placeholder="Nama tempat wisata" className={(errors.name) ? "form-control is-invalid" : "form-control"} />
              {(errors.name) ?
                errors.name.map(error => (<span className="invalid-feedback">{error}</span>)) : ''
              }
              <label htmlFor="" className="control-label mb-1 mt-1">Alamat tempat wisata</label>
              <input type="text" onChange={this.onChange} value={address} name="address" placeholder="Alamat tempat wisata" className={(errors.address) ? "form-control is-invalid" : "form-control"} />
              {(errors.address) ?
                errors.address.map(error => (<span className="invalid-feedback">{error}</span>)) : ''
              }
              <label htmlFor="" className="control-label mb-1 mt-1">Tipe wisata</label>
              <select name="travel_type_id" onChange={this.onChange} value={travel_type_id} id="" className={(errors.travel_type_id) ? "form-control is-invalid" : "form-control"}>
                <option value="">Pilih tipe wisata</option>
                {this.state.types.map((type, i) => (<option key={i} value={type.id}>{type.name}</option>))}
              </select>
              {(errors.travel_type_id) ?
                errors.travel_type_id.map(error => (<span className="invalid-feedback">{error}</span>)) : ''
              }
              <label htmlFor="" className="control-label mb-1 mt-1">Deskripsi tempat wisata</label>
              <textarea name="description" onChange={this.onChange} value={description} rows="5" placeholder="Deskripsi" className={(errors.description) ? "form-control is-invalid" : "form-control"} />
              {(errors.description) ?
                errors.description.map(error => (<span className="invalid-feedback">{error}</span>)) : ''
              }
              <hr />
              <button type="submit" onClick={this.postData} className="btn btn-outline-success btn-sm">Buat</button>
            </form>
            <input accept={['image/jpg', 'image/png', 'image/jpeg']} type="file" name="photo" ref={ref => this.file = ref} className="d-none" onChange={this.onFileSelected} />
          </div>
          {/*  */}
          <div className="col-md-6">
            <FormMap position={{ lat: latitude, lng: longitude }} address={(address) => this.setState({ address })} onCoordChange={({ latitude, longitude }) => this.setState({ latitude, longitude })} />
            <hr />
            <button onClick={() => this.file.click()} className="btn btn-outline-success btn-block my-2">Tambah Gambar</button>
            {this.state.progress > 0 &&
            <Fragment>
              <p className="small text-center text-muted">Mengupload</p>
              <div className="progress">
                <div style={{ width : `${this.state.progress}%` }} className="progress-bar progress-bar-striped progress-bar-animated">{this.state.progress}%</div>
              </div>
            </Fragment>
            }
            <hr />
          </div>
          <div className="container">
            {this.state.site_pictures.map((pic, i) => (<div key={i} className="preview shadow-sm">
              <img src={`${baseurl}/storage/img/${pic.photo}`} alt="" className="img-fluid" />
            </div>))}
          </div>
        </div>
      </Fragment>
    )
  }
}

if (document.getElementById('travel-edit')) {
  ReactDOM.render(<TravelSiteEdit />, document.getElementById('travel-edit'));
}