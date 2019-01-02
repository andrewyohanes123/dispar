import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FormMap from './FormMap';
import Dropzone from 'react-dropzone';
// import { fdatasync } from 'fs';

export class TravelSiteForm extends Component {
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
      errors: []
    }

    this.getTypes = this.getTypes.bind(this);
    this.onChange = this.onChange.bind(this);
    this.onFileSelected = this.onFileSelected.bind(this);
    this.postData = this.postData.bind(this);
    this.convertFile = this.convertFile.bind(this);
  }

  getTypes() {
    axios.get('/api/types').then(resp => {
      this.setState({ types: resp.data });
    });
  }

  componentDidMount() {
    this.getTypes();
  }

  onChange(ev) {
    this.setState({
      [ev.target.name]: ev.target.value
    })
  }

  convertFile(files) {
    const { photo } = this.state;
    let b64 = new FileReader();
    for (let i = 0; i < files.length; i++) {
      console.log(btoa(files[i]))
      // b64.onload = (e) => {
      //   photo.push(e.target.result);
      //   console.log(e.target.result);
      //   this.setState({
      //     photo
      //   })
      // }
    }
    // b64.readAsDataURL(files)
  }

  onFileSelected(ev) {
    this.setState({
      photo: ev,
      files: ev.map(file => Object.assign(file, {
        preview: URL.createObjectURL(file)
      }))
    })
  }

  async postData(ev) {
    const { name, address, description, travel_type_id, longitude, latitude, photo } = this.state;
    ev.preventDefault();
    const FD = new FormData();

    for (let i = 0; i < photo.length; i++) {
      // console.log(Array.from(photo)[0]);
      FD.append('photo[]', photo[i], photo[i].name);
    }
    FD.append('name', name);
    FD.append('address', address);
    FD.append('description', description);
    FD.append('travel_type_id', travel_type_id);
    FD.append('longitude', longitude);
    FD.append('latitude', latitude);

    try {
      resp = await axios.post('/dashboard/tempat-wisata/', FD, { headers: { 'Content-Type': 'multipart/form-data' } })
      console.log(resp.status);
      // if (resp.status === 422)
      // {
      // } else {
      this.setState({ name: '', address: '', description: '', travel_type_id: '', photo: [] })
      // }
    } catch (error) {
      // console.log(error.response.data.errors)
      this.setState({ errors: error.response.data.errors })
    }
    // return resp;
    // }).catch(resp => console.log(resp));

    // console.log(FD);
  }

  render() {
    const { name, address, description, travel_type_id, errors } = this.state;
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

    const imgs = this.state.files.map((file, i) => (<div style={thumb} key={i}>
      <div style={thumbInner}>
        <img src={file.preview} style={img} alt="" />
      </div>
    </div>))

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
              <Dropzone
                accept={["image/jpg","image/jpeg", "image/png"]}
                onDropAccepted={this.onFileSelected}
                multiple={true}
              >
                {({ getRootProps, getInputProps }) => (
                  <div style={baseStyle} {...getRootProps()}>
                    <input {...getInputProps()} />
                    <h1><i className="fa fa-file fa-lg"></i></h1>
                    <p className="m-0 text-muted">{this.state.photo.length} file</p>
                    {imgs}
                  </div>
                )}
              </Dropzone>
              <hr />
              <button type="submit" onClick={this.postData} className="btn btn-outline-success btn-sm">Buat</button>
            </form>
          </div>
          <div className="col-md-6">
            <FormMap onCoordChange={({ latitude, longitude }) => this.setState({ latitude, longitude })} />

          </div>
        </div>
      </Fragment>
    )
  }
}

if (document.getElementById('travel-form')) {
  ReactDOM.render(<TravelSiteForm />, document.getElementById('travel-form'));
}