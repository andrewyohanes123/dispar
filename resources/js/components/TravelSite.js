import React, { Component, Fragment } from 'react'
import ReactDOM from 'react-dom';
import axios, { get } from 'axios';
import baseurl from './BaseURL';

export default class TravelSite extends Component {
  constructor(props) {
    super(props);

    this.state = {
      sites: [],
      page: 1,
      last_page: 2,
      q: ''
    }

    this.getSites = this.getSites.bind(this);
    this.trackScreen = this.trackScreen.bind(this);
    this.onSearch = this.onSearch.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
  }

  componentDidMount() {
    this.getSites();
    document.addEventListener('scroll', this.trackScreen);
  }

  trackScreen(ev) {
    const { scrollingElement: scroll } = ev.target;
    // console.log(`client height : ${scroll.clientHeight}` , scroll.scrollHeight - scroll.scrollTop);
    if (scroll.clientHeight === scroll.scrollHeight - scroll.scrollTop) {
      this.setState(({ page, last_page }) => {
        (page === last_page) ? page = last_page : page++;
        return { page }
      }, () => this.getSites());
    }
  }

  getSites() {
    const { page: pageParams, q } = this.state;
    get('/dashboard/travel-site', { params: { page: pageParams, q } }).then(resp => this.setState(({ sites, last_page, page }) => {
      console.log(page === last_page ? 'last page' : `page ${page}`)
      return page === last_page ? { sites: [...resp.data.data], last_page: resp.data.last_page } : { sites: [...sites, ...resp.data.data], last_page: resp.data.last_page }
    }));
  }

  deleteSite(id) {
    axios.delete(`${baseurl}/dashboard/travel-site/${id}`).then(resp => console.log(resp)).catch(err => console.log(err))
  }

  onSearch(ev) {
    this.setState({ q : ev.target.value, sites : [], page : 1 }, this.getSites);
  }

  onSubmit(ev) {
    ev.preventDefault();
    this.getSites();
  }

  render() {
    const { sites } = this.state;
    return (
      <Fragment>
        <div className="d-flex flex-row justify-content-between align-items-center">
          <h4 className="m-0"><i className="fa fa-map-marker fa-lg"></i>&nbsp;Tempat Wisata | <a href={`${baseurl}/dashboard/tempat-wisata/create`} className="btn btn-outline-success btn-sm"><i className="fa fa-plus-square fa-fw"></i>&nbsp;Tambah tempat wisata</a></h4>
          <form onSubmit={this.onSubmit} action="" method="get">
            <div className="input-group">
              <input name="q" value={this.state.q} onChange={this.onSearch} type="text" placeholder="Cari tempat wisata" className="form-control" />
              <div className="input-group-append"><button className="btn btn-dark"><i className="fa fa-search fa-lg"></i></button></div>
            </div>
          </form>
        </div>
        <hr/>
        {/*  */}
        <div className="card-columns" onScroll={this.trackScreen}>
          {sites.map((site, i) => (<div key={i} className="card">
            <img src={`/storage/img/${site.site_pictures[0].photo}`} alt={site.name} title={site.name} className="card-img-top" />
            <div className="card-body">
              <h4 className="m-0">{site.name}</h4>
              <p className="text-muted small">{site.site_type.name} | {site.travel_type.name}</p>
              <p className="m-0 text-truncate">{site.description}</p>
              <hr />
              <a href={`${baseurl}/dashboard/tempat-wisata/${site.id}/edit`} className="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title={`Edit ${site.name}`} ><i className="fa fa-edit fa-lg"></i></a>
              <a href={`${baseurl}/dashboard/tempat-wisata/${site.id}`} className="btn btn-danger btn-sm" title={`Hapus ${site.name} ?`} ><i className="fa fa-remove fa-lg"></i></a>
              <a href={`${baseurl}/dashboard/tempat-wisata/${site.id}`} className="btn btn-primary btn-sm" title={`Preview ${site.name}`} ><i className="fa fa-eye fa-lg"></i></a>
            </div>
          </div>))}
        </div>
      </Fragment>
    )
  }
}

if (document.getElementById('travel-site')) {
  ReactDOM.render(<TravelSite />, document.getElementById('travel-site'));
}