import React from "react";
import { LoadingOutlined } from "@ant-design/icons";
import { Spin } from "antd";
import "./Spinner.css";

const Spinner = () => {
  const spinIcon = <LoadingOutlined style={{ fontSize: 75 }} spin />;

  return (
    <div className="spinner">
      <Spin indicator={spinIcon} />
    </div>
  );
};

export default Spinner;
