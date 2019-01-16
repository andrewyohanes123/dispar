import React, { Component, Fragment } from 'react';
import axios from 'axios';
import ReactDOM from 'react-dom';
import baseurl from './BaseURL';
import moment from 'moment';
// import 'moment/src/locale/id';


export default class Event extends Component {
  constructor(props) {
    super(props);

    this.state = {
      months: [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
      ],
      month: 1,
      page: 1,
      total_pages: 2,
      events: [],
      loading: false
    }

    this.getEvent = this.getEvent.bind(this);
  }

  componentDidMount() {
    moment.locale('ID');
    this.getEvent();
  }

  changeMonth(ev) {
    this.setState({ loading: true })
    this.setState({ month: ev.target.value }, this.getEvent);
  }

  getEvent() {
    const { month, page } = this.state;
    axios.get(`${baseurl}/event-api`, { params: { month, page } }).then(resp => this.setState({ events: resp.data.data, total_pages: resp.data.last_page, loading: false }));
  }

  render() {
    return (
      <Fragment>
        <div className="d-flex my-3 flex-row justify-content-between align-items-center">
          <h4 className="m-0"><i className="fa fa-calendar fa-md"></i>&nbsp;Event</h4>
          <form action="">
            <select value={this.state.month} name="" onChange={this.changeMonth.bind(this)} id="" className="form-control">
              <option value={0}>Pilih bulan</option>
              {this.state.months.map((month, i) => (<option key={i} value={i + 1}>{month}</option>))}
            </select>
          </form>
        </div>
        {this.state.loading ? <div className="card text-center">
          <div className="card-body">
            <span className="spinner-border text-primary"><span className="sr-only">Loading...</span></span>
            <h4 className="m-0">Loading</h4>
          </div>
        </div> : this.state.events.length > 0 ?
            this.state.events.map(event => (<EventCard key={event.id} {...event} />))
            :
            <div className="card">
              <div className="card-body"><h4 className="m-0">Tidak ada event pada bulan {this.state.months[(this.state.month - 1)]}</h4></div>
            </div>
        }
        <hr />
      </Fragment>
    )
  }
}

const EventCard = props => (
  <div className="card border-0 shadow-sm my-2 d-flex flex-row">
    <svg width="150" height="150" className="card-img card-img-left d-block w-auto">
      <rect fill="#3867d6" height="100%" width="100%"></rect>
      <text x="50%" fill="#fff" y="45%" fontSize={50} textAnchor="middle" alignmentBaseline="middle" >{moment(props.event_from).format('D')}</text>
      <text x="50%" fill="#fff" y="65%" textAnchor="middle" fontSize={25} alignmentBaseline="middle" >{moment(props.event_from).format('MMM')}</text>
    </svg>
    <div className="card-body">
      <h4 className="m-0">{props.name}</h4>
      <p className="text-muted m-0">{props.event_location.location}</p>
      <p className="m-0"><i className="fa fa-calendar fa-lg"></i>&nbsp;{moment(props.event_from).format('D MMM YYYY')} - {moment(props.event_to).format('D MMM YYYY')}</p>
    </div>
  </div>
)

if (document.getElementById('event')) {
  ReactDOM.render(<Event />, document.getElementById('event'));
}