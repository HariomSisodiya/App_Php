import './Sidebar.css';
import { Link } from "react-router-dom";
import photo from '../assets/student.png';

function SideBar() {
    return <>
        <div className="wrapper">
            <div className="sidebar">
                <div className="user-info ml-5 mt-5">
                    <img src={photo} alt="User Profile" className="profile-image" />
                    <h3 className="fw-bold text-white">Ram</h3>
                    <small className='text-warning'>student</small>
                </div>
                <nav className="sidebar-nav">
                    <Link to="/" id='adjust' >
                        <i className="fas fa-home"></i>
                        <span>Home</span>
                    </Link>
                    <Link to="#" id='adjust'>
                        <i className="fas fa-user"></i> Profile
                    </Link>
                    <Link to="Courses" id='adjust1' >
                        <i className="fas fa-book"></i> Courses
                    </Link>
                    <Link to="#" id='adjust2'>
                        <i className="fas fa-chart-bar "></i> Course-list
                    </Link>
                    <Link to="#" id='adjust3'>
                        <i className="fas fa-square-check"></i> Report
                    </Link>
                    <Link to="#" id='adjust'>
                        <i className="fa-solid fa-right-from-bracket"></i> Logout
                    </Link>
                </nav>
            </div>
        </div>
    </>
}

export default SideBar;