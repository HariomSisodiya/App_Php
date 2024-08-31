import './Sidebar.css';
import { Link } from "react-router-dom";
import photo from '../assets/student.png';
import { useEffect, useState } from 'react';
import axios from 'axios';

interface Student {
    name: string;
    // Add other properties that you expect to get from the API
}

function SideBar() {
    const [profile, setProfile] = useState<Student | null>(null);

    
    
    useEffect(() => {
        const id = sessionStorage.getItem('studentId'); // Changed to 'studentId' based on your earlier code
        console.log("Student : ", id);
        console.log("auth_token",localStorage.getItem("auth_token"));
        
        if (id) {
            axios.get(`http://localhost:8080/student/${id}`)
                .then((result) => {
                    console.log("Profile Data: ", result.data);
                    setProfile(result.data.student);
                })
                .catch((err) => {
                    console.log(err);
                });
        }
    },[]);

    return (
        <div className="wrapper">
            <div className="sidebar">
                <div className="user-info ml-5 mt-5">
                    <img src={photo} alt="User Profile" className="profile-image" />
                    <h3 className="fw-bold text-white">{profile?.name}</h3>
                    <small className='text-warning'>student</small>
                </div>
                <nav className="sidebar-nav">
                    <Link to="/" id='adjust'>
                        <i className="fas fa-home"></i>
                        <span>Home</span>
                    </Link>
                    <Link to="#" id='adjust'>
                        <i className="fas fa-user"></i> Profile
                    </Link>
                    <Link to="/Courses" id='adjust1'>
                        <i className="fas fa-book"></i> Courses
                    </Link>
                    <Link to="/courseList" id='adjust2'>
                        <i className="fas fa-chart-bar"></i> Course-list
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
    );
}

export default SideBar;
