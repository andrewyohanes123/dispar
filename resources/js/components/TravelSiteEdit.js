import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FormMap from './FormMap';
import UploadingModal from './UploadingModal';

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
      site_pictures : []
    }

    this.getTypes = this.getTypes.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onFileSelected = this.onFileSelected.bind(this);
    this.onFileSelect = this.onFileSelect.bind(this);
    this.postData = this.postData.bind(this);
    this.getSite = this.getSite.bind(this);
  }

  getTypes() {
    axios.get('/api/types').then(resp => {
      this.setState({ types: resp.data });
    });
  }

  getSite() {
    const id = document.querySelector('meta[name="travel-id"]').content;
    axios.get(`/dashboard/tempat-wisata/${id}/api`).then(resp => {
      const { name, address, description, latitude, longitude, site_pictures,travel_type_id} = resp.data;
      this.setState({ name, address, description, latitude, longitude, site_pictures,travel_type_id});
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
    this.setState({
      photo: ev,
      files: ev.map(file => Object.assign(file, {
        preview: URL.createObjectURL(file)
      }))
    })
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
    const { name, address, description, travel_type_id, longitude, latitude, photo } = this.state;
    ev.preventDefault();
    const FD = new FormData();
    FD.append('photo', photo);
    FD.append('name', name);
    FD.append('address', address);
    FD.append('description', description);
    FD.append('travel_type_id', travel_type_id);
    FD.append('longitude', longitude);
    FD.append('latitude', latitude);

    // try {
      axios.post('/dashboard/tempat-wisata/', FD, {
        onUploadProgress : progress => this.setState({ progress : Math.round((progress.loaded * 100) / progress.total)}) ,
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(resp => {
        this.uploadModal.openModal();
        if (resp.data.site) this.setState({ name: '', address: '', description: '', travel_type_id: '', files : [], photo : [] }, () => this.fileInput.value = '');
      }).catch(error => this.setState({ errors: error.response.data.errors }));
  }

  render() {
    const { name, address, description, travel_type_id, errors, latitude, longitude } = this.state;
    const baseStyle = {
      width: '100%',
      height: 'auto',
      borderWidth: 0.5,
      borderColor: '#666',
      borderStyle: 'solid',
      borderRadius: 5,
      padding: 10,
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'center',
      alignItems: 'center',
      cursor: 'pointer'
    };
    const thumb = {
      display: 'inline-flex',
      borderRadius: 2,
      border: '1px solid #eaeaea',
      marginBottom: 8,
      marginRight: 8,
      width: 300,
      height: 300,
      padding: 4,
      boxSizing: 'border-box'
    };

    const thumbInner = {
      display: 'flex',
      minWidth: 0,
      overflow: 'hidden'
    }

    const img = {
      display: 'inline',
      width: 'auto',
      height: '100%'
    };

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
              <label htmlFor="" className="control-label mb-1 mt-1">Gambar tempat wisata</label>
              <input type="file" name="photo" id="" onChange={this.onFileSelect} key={ref => this.fileInput = ref} multiple={false} accept={['image/jpg', 'image/jpeg', 'image/png']} className="form-control" />
              <hr />
              <button type="submit" onClick={this.postData} className="btn btn-outline-success btn-sm">Buat</button>
            </form>
          </div>
          <div className="col-md-6">
            <FormMap position={{ lat : latitude, lng : longitude }} address={(address) => this.setState({ address })} onCoordChange={({ latitude, longitude }) => this.setState({ latitude, longitude })} />
            {this.state.files.length !== 0 && <img src={this.state.files.preview} alt="" className="img-fluid img-thumbnail my-2" />}
          </div>
        </div>
        <UploadingModal ref={ref => this.uploadModal = ref} progress={this.state.progress} />
      </Fragment>
    )
  }
}

if (document.getElementById('travel-edit')) {
  ReactDOM.render(<TravelSiteEdit />, document.getElementById('travel-edit'));
}