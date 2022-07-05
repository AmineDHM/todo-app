import React from "react";
import { LoadingOutlined } from "@ant-design/icons";
import { Spin } from "antd";

const Spinner = () => {
  const spinIcon = <LoadingOutlined style={{ fontSize: 75 }} spin />;

  return (
    <div style={{ margin: "0 auto" }}>
      <Spin indicator={spinIcon} />
    </div>
  );
};

export default Spinner;
